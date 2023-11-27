// Handle
const slideGroup = document.querySelectorAll('.content1 .slide-group');
const dot = document.querySelectorAll('.content1 .slide .circle');
console.log(dot)
slideGroup.forEach((slide, index) => {
    slide.style.opacity = index != 0 ? 0 : 1;
})
let index = 0;
let prevIndex;
dot[0].classList.add('active');

function showSlide() {
    slideGroup[prevIndex].style.opacity = 0;
    slideGroup[index].style.opacity = 1;
    dot[prevIndex].classList.remove('active');
    dot[index].classList.add('active');
}
setInterval(() => {
    prevIndex = index++;
    index = index >= slideGroup.length ? 0 : index;
    showSlide();
}, 4000);
dot.forEach((item, indexDot) => {
    item.onclick = function () {
        prevIndex = index;
        index = indexDot;
        showSlide();
    }
})
(() => {
  const data_content = GET_contentImg.find(item => item.name == 'Content1-Img');
  const images = document.querySelectorAll('.content1 .content1-img');
  images.forEach((img, index) => {
      img.src = data_content.galeryImage[index];
      if (index == 0) {
          const height = window.innerHeight;
          window.addEventListener('scroll', function () {
              let distance = img.getBoundingClientRect().top;
              let opc = (height - distance - 0.2 * height) / height;
              img.style.opacity = opc;
          })
      }
  })
})();