@extends('layout/main')

@section('title', 'Home')
	
@section('container')
<!-- <div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle"> -->
<div class="wrapper">
    <div class="main-content">
        <div class="container-fluid">
			<div class="slidershow middle">
				<div class="slides">
					<input type="radio" name="r" id="r1" checked>
					<input type="radio" name="r" id="r2">
					<input type="radio" name="r" id="r3">
					<div class="slide s1">
						<img src="{{asset('images/1.jpg')}}" alt="">
					</div>
					<div class="slide">
						<img src="{{asset('images/2.jpg')}}" alt="">
					</div>
					<div class="slide">
						<img src="{{asset('images/3.jpg')}}" alt="">
					</div>
				</div>

				<div class="navigation">
					<label for="r1" class="bar"></label>
					<label for="r2" class="bar"></label>
					<label for="r3" class="bar"></label>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<style>
	body{
    margin: 0;
    padding: 0;
    background: #34495e;
  }
  .slidershow{
    width: 1000px;
    height: 500px;
    overflow: hidden;
  }
  .middle{
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%,-50%);
  }
  .navigation{
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
  }
  .bar{
    width: 50px;
    height: 10px;
    border: 2px solid #fff;
    margin: 6px;
    cursor: pointer;
    transition: 0.4s;
  }
  .bar:hover{
    background: #fff;
  }
  
  input[name="r"]{
      position: absolute;
      visibility: hidden;
  }
  
  .slides{
    width: 500%;
    height: 100%;
    display: flex;
  }
  
  .slide{
    width: 20%;
    transition: 0.6s;
  }
  .slide img{
    width: 100%;
    height: 100%;
  }
  
  #r1:checked ~ .s1{
    margin-left: 0;
  }
  #r2:checked ~ .s1{
    margin-left: -20%;
  }
  #r3:checked ~ .s1{
    margin-left: -40%;
  }
  
</style>