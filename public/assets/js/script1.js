const formationCardTemplate = document.querySelector("[data-formation-template]")
const formationCardContainer = document.querySelector("[data-formation-cards-container]")
const searchInput = document.querySelector("[data-search]")

let formations = []

searchInput.addEventListener("input", e => {
   
    const value = e.target.value.toLowerCase()
    formations.forEach(formation => {
         
        const isVisible = formation.title.toLowerCase().includes(value) || formation.description.toLowerCase().includes(value)
        console.log(formation.element.classList)
        formation.element.classList.toggle("d-none", !isVisible )
    })
    
})


 fetch("http://127.0.0.1:8000/api/formations?page=1")
.then(res => res.json())
.then(data => { return data['hydra:member']})
.then(data1=> {
   formations = data1.map(formation => {     
        const card = formationCardTemplate.content.cloneNode(true).children[0]
         const header = card.querySelector("[data-header]")
         const body = card.querySelector("[data-body]")
         header.textContent= formation.title 
         body.textContent= formation.description 
         formationCardContainer.append(card)
         return { title: formation.title, description: formation.description, element: card}
         })
 })
