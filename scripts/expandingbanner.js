function initBanner(){
  var bannercontainer = document.getElementById("bannercontainer");
  bannercontainer.style.position = "absolute";
  bannercontainer.style.display = "block";
  bannercontainer.style.overflow = "hidden";
  bannercontainer.style.height = "60px";
  bannercontainer.style.zIndex = "999999999";

}

function showBanner(){
  document.getElementById("bannercontainer").style.height = "180px";
}

function hideBanner(){
  document.getElementById("bannercontainer").style.height = "60px";
}


function initSideBanner(){
  var bannercontainer2 = document.getElementById("banner_left");
  bannercontainer2.style.position = "absolute";
  bannercontainer2.style.display = "block";
  bannercontainer2.style.overflow = "hidden";
  bannercontainer2.style.height = "130px";
  bannercontainer2.style.zIndex = "999999999";

}

function showSideBanner(){
  document.getElementById("banner_left").style.width = "400px";
}

function hideSideBanner(){
  document.getElementById("banner_left").style.width = "300px";
}