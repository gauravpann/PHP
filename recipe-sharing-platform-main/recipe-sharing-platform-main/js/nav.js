if(location.href=='http://localhost:8080/recipe/login.php#login')
document.querySelector('.ri').classList.add('active1')



const sections = document.querySelectorAll('section');

function updateActiveNavItem() {
    
let scrollPosition = window.scrollY;
sections.forEach(section => {
    
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;
    

if (scrollPosition >= sectionTop-1 && scrollPosition < sectionTop + sectionHeight){
    const sectionId = section.getAttribute('id');
    const correspondingNavItem = document.querySelector(`a[data-href="#${sectionId}"]`);
    if (correspondingNavItem) {

        
        document.querySelectorAll('li a').forEach(link => {
            // console.log(document.querySelectorAll('li a'))
            link.classList.remove('active1');
            
        });

        correspondingNavItem.classList.add('active1');
    }
}
});
}


window.addEventListener('scroll', updateActiveNavItem);
window.addEventListener('load',updateActiveNavItem)
