const cards = document.querySelectorAll('.card');

cards.forEach((card) => {

    card.addEventListener("click", (e) => {
        const input = card.querySelector('input')
        input.click()
       
        
    
    })
}
)