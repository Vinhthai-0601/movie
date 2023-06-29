function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
    var opac = document.getElementById("blur");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      opac.style.opacity = "0.5";
      btnText.innerHTML = "Read more";
      moreText.style.display = "none";
    } else {
      opac.style.opacity = "0";
      dots.style.display = "none";
      btnText.innerHTML = "Read less";
      moreText.style.display = "inline";
    }
}