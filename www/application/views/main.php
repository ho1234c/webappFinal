<div class="zoomin">
	<button type="button" class="btn btn-default btn-md">
		<span class="glyphicon glyphicon-plus"></span>
	</button>
</div>

<div class="zoomout">
	<button type="button" class="btn btn-default btn-md">
		<span class="glyphicon glyphicon-minus"></span>
	</button>
</div>

<div class="menuicon">
	<button type="button" class="btn btn-default btn-md">
		<span class="glyphicon glyphicon-menu-hamburger"></span>
	</button>
</div>

<div class="sidebar">
	<button type="button" class="btn btn-default btn-md pull-left" id="sidebar-close">
		<span class="glyphicon glyphicon-menu-hamburger"></span> 
	</button>

	<button type="button" class="btn btn-default btn-md" id="logout">
		<span class="glyphicon glyphicon-log-out"></span> Log out
	</button>
</div>

<div class="map_wrap">
	<div id="map"></div> <!-- 지도를 표시할 div 입니다 -->

	<div id="dialog-form" title="file select">
		<form action="" method="POST" id="upload_file" enctype="multipart/form-data">
			<a href="#" class="thumbnail">
				<img id="thum" src="/static/img/no_image.jpg">
			</a>
			<button type="button" class="btn btn-default pull-left col-md-5" id="btn-upload">select</button>
			<input type="file" name="product_pic" id="product">
			<button type="button" id="uploadbutton" class="btn btn-default pull-right col-md-5" name="submit">submit</button>
		</form>
	</div>

</div>
<div class="slider_wrap">

	<div id="blueimp-gallery" class="blueimp-gallery">
		<div class="slides"></div>
		<h3 class="title"></h3>
		<a class="prev">‹</a>
		<a class="next">›</a>
		<a class="close">×</a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
	</div>



</div>
<div id="gallery">

</div>

<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=43adf80443e24f2ed2c9c1d4a36784b3"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/static/lib/bootstrap/js/bootstrap.min.js"></script>

<script src="/static/js/ajaxfileupload.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/static/lib/Gallery-master/js/jquery.blueimp-gallery.min.js"></script>
<script src="/static/js/jquery.sidebar.js"></script>



<script>

	$(document).ready(function(){
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div  

	mapOption = { 
		center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
		level: 7 // 지도의 확대 레벨
	};
	var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성

	var marker_array = <?php echo json_encode($marker) ?>; //서버에서 데이터 받아옴

	var marker_obj = []; //커스텀 오버레이 들을 넣을 배열

	console.log(marker_array.length);
	var test = JSON.stringify(marker_array);
	console.log(test);

	var current_marker = ""; //현재 이벤트가 있는 마커 id

	var gallery_tag = "";

	for(i in marker_array){
	marker_obj.push(setFrames(marker_array[i]));	//커스텀 오버레이 오브젝트 배열에 넣어줌

	gallery_tag += makeGallery(marker_array[i]);	//갤러리 태그 만들어줌
}
$('#gallery').append($(gallery_tag));
$(".sidebar").sidebar({side: "right"});
$(".menuicon").click(function(){
	$(".sidebar").trigger("sidebar:open");	
})
$("#sidebar-close").click(function(){
	$(".sidebar").trigger("sidebar:close");	
})
$("#logout").click(function(){
	window.location.href = "http://ec2-52-68-75-252.ap-northeast-1.compute.amazonaws.com/index.php/auth/logout";
})

$(".zoomin").click(function(){
	var current_width = $(".image-frame .gallery-image img").width();
	console.log(current_width);
	if(current_width < 500){
		$('.image-frame .gallery-image img').width($('.image-frame .gallery-image img').width()*1.2);
		$('.image-frame').width($('.image-frame').width()*1.2);
	}

})

$(".zoomout").click(function(){
	var current_width = $(".image-frame .gallery-image img").width();
	console.log(current_width);

	if(current_width > 10){
		$('.image-frame .gallery-image img').width($('.image-frame .gallery-image img').width()/1.2);
		$('.image-frame').width($('.image-frame').width()/1.2);
	}

})
drawImage(marker_obj);

//지도 확대 축소이벤트
daum.maps.event.addListener(map, 'zoom_changed', function() {       

	var level = map.getLevel();
	if(level > 12){
		for(i in marker_obj){
			marker_obj[i].setVisible(false);
		}
	}else{
		for(i in marker_obj){
			marker_obj[i].setVisible(true);
		}

	}
});


//맵에 클릭하면 다이얼로그 오픈
daum.maps.event.addListener(map, 'click', function(mouseEvent) {
	current_marker = mouseEvent.latLng;
	$('#dialog-form').dialog({
		modal: true,
		position: {
			my: "left top",
			of: event,
			collision: "fit"}});

	$('#dialog-form').dialog('open');
});



//AJAX 파일전송
$('#uploadbutton').click(function(){
	var inputfile = $('input[name=product_pic]');

	var filetoUpload = inputfile[0].files[0];
	console.log(filetoUpload);

	if(filetoUpload !== undefined){
		$.ajaxFileUpload({
			url         :'/index.php/Marker/add',
			secureuri      :false,
			fileElementId  :'product',
			dataType    : 'json',
			data        : {
				'lat' : current_marker.getLat(),
				'lng' : current_marker.getLng()
			},
			success : function (data)
			{
				marker_obj.push(setFrames(data[data.length-1]))		//데이터 다시 받아와서 마지막 요소만 배열에 푸쉬
				drawImage(marker_obj);								//다시 그려줌
				$("form").each(function() {  
					if(this.id == "upload_file") this.reset();		//modal form 리셋
				});
				$('#thum').attr('src', '/static/img/no_image.jpg'); //modal에 썸네일 리셋

				$('#gallery').append(makeGallery(data[data.length-1])); //갤러리에 추가된 사진 append
				$('#dialog-form').dialog('close');

			}
		})

	}})


//파일전송 다이얼로그를 만들어줌
$(function() {
	$( "#dialog-form" ).dialog({
		autoOpen: false,
		modal: true,
		height: 300,
		width: 300,
	})
});

//파일선택 버튼 스타일을 바꿔주는함수
$(function () {
	$('#btn-upload').click(function (e) {
		e.preventDefault();
		$('#product').click();
	});
});


//갤러리 태그를 만들어주는 함수
function makeGallery(marker_array){
	var tag = '<a href="'+ ' /static/user/' + marker_array['image'] + '" '   //갤러리 태그 만들어줌
	+'data-gallery="#blueimp-gallery" class="gallery-image"'
	+'data-id='+ marker_array['id']
	+'>'
	+'<img src="'+ '/static/user/' + marker_array['image'] + '"' +'>'
	+'</a>';

	return tag;
}

//갤러리 클릭하면 맵 중심을 이동
$('.gallery-image').click(function(){
	var marker_id = this.getAttribute("data-id");
	for (i in marker_array){
		if(marker_array[i]['id'] == marker_id){
			var moveLatLon = new daum.maps.LatLng(marker_array[i]['lat'], marker_array[i]['lng']);
			map.panTo(moveLatLon);
		}
	}
})


$(document).on('change', '#product:file', function() {
	console.log(this);
	readURL(this.files);
})


// 등록한 이미지 썸네일
function readURL(url) {
		console.log('aa');
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#thum').attr('src', e.target.result);
		}                   
		reader.readAsDataURL(url[0]);
}


//커스텀오버레이를 생성하는함수
function setFrames(marker) {
	var contentNode = document.createElement('div');

	var coContent = '<div class="image-frame">'
	+'<a href="'+ ' /static/user/' + marker['image'] + '" '
	+'data-gallery="#blueimp-customOverlay" class="gallery-image">'
	+'<img src="'
	+'/static/user/' + marker['image'] + '"'+ 'width="200px" class="img-thumbnail"/></a></div>'; 
	contentNode.innerHTML = coContent;
    var coPosition = new daum.maps.LatLng(marker['lat'], marker['lng']); //인포윈도우 표시 위치입니다

    //커스텀 오버레이 클릭시 맵 이벤트를 막아줌
    contentNode.addEventListener('mousedown', daum.maps.event.preventMap);
    contentNode.addEventListener('touchstart', daum.maps.event.preventMap);


	// 커스텀오버레이 생성
	var customOverlay = new daum.maps.CustomOverlay({
		position : coPosition, 
		content : contentNode 
	});


	return customOverlay;

}

//커스텀오버레이를 그려주는 함수
function drawImage(customOverlay){
	for (i in customOverlay){
		if(customOverlay[i].getMap() == null){
			customOverlay[i].setMap(map);
		}			

	}
}
})





</script>