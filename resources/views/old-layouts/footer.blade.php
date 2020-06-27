<div class="footer-w3l">
	<div class="container">
		<div class="footer-grids">
			<div class="col-md-4 footer-grid">
				<h4>Contact</h4>
				<h4>Second Hand Shop</h4>
				<ul class="text-md" style="color: #ffffff">
					<li class="pad-t-5">
						<i class="fa fa-map-marker"></i>
						Basundhara Marg Kathmandu, Nepal 44600
					</li>
					<li class="pad-t-20">
						<i class="fa fa-phone"></i>
						+977 985-1234047
					</li>
					<li class="pad-t-20">
						<i class="fa fa-envelope"></i>
						<a href="mailto:secondhand@ktmsecondhand.com" style="color: inherit;">secondhand@ktmsecondhand.com</a>
					</li>
					<li>
						<div class="social-icon">
							<a href="https://www.facebook.com/secondhandshop.ktm/" target="_blank"><i class="icon"></i></a>
							<a href="#"><i class="icon1"></i></a>
							{{-- <a href="#"><i class="icon2"></i></a>
							<a href="#"><i class="icon3"></i></a> --}}
						</div>
					</li>
				</ul>
			</div>
			<div class="col-md-3 footer-grid">
				<h4>Categories</h4>
				<ul class="text-md" style="color: #ffffff">
					<li class="pad-t-10"><a href="{{ route('general.category', 'home_furniture') }}" class="color-inherit">Home furniture</a>
						
					</li>
					<li class="mar-t-20"><a href="{{ route('general.category', 'office_furniture') }}" class="color-inherit">Office furniture</a>
						
					</li>
					<li class="mar-t-20"><a href="{{ route('general.category', 'electronics') }}" class="color-inherit">Electronics</a>
						
					</li>
					<li class="mar-t-20 pad-b-10">
						<a href="{{ route('general.category', 'others') }}" class="color-inherit">Others</a>
					</li>
				</ul>
			</div>
			<div class="col-md-5 footer-grid">
				<h4>Our location on map</h4>
				<section id="google-map" style="padding-bottom: 50px">
					<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAdv7hhLjpkDN4YrZ6FX7tGx1n37wv1ZwY"></script>
					    <div style='overflow:hidden;height:220px;width:100%;padding-bottom: 50px'><div id='gmap_canvas' style='height:250px;width:100%;' class="wow animated fadeInUp"></div>
					        <div></div>
					        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
					    </div>
					<script type='text/javascript'>function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(27.741509555869, 85.330212414265),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(27.741509555869, 85.330212414265)});infowindow = new google.maps.InfoWindow({content:'<strong>Second Hand Shop</strong><br>Basundhara, Kathmandu, Nepal<br> <i class="fa fa-phone bg-info"></i>985-1234047 <br/><small><a href="https://www.google.com/maps?ll=27.741459,85.329955&z=20&t=m&hl=en-US&gl=US&mapclient=apiv3&cid=5472223104045459366" target="_blank">view on google maps</a></small>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

				</section>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><small class="text-md" style="color: #ffffff">Copyright &copy; {{ date('Y') }} <a href="http://ktmsecondhand.com" style="color: #94d5f9;">ktmsecondhand.com</a> Designated trademarks and brands are the property of their respective owners. Use of this web site constitutes acceptance of the <a href="#" target="_blank" style="color: #94d5f9;">Terms Of Use</a> , <a href="#" target="_blank" style="color: #94d5f9;">Safety Tips</a>, <a href="#" target="_blank" style="color: #94d5f9;">Ad Posting Rules</a>.</small></p>
			</div>
		</div>
	</div>
</div>