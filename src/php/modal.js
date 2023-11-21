const refs = {
    movieCard: document.querySelector('.card__text'),
    modal: document.querySelector('.modal'),
    closeBtn: document.querySelector('.closeModal'),
    body: document.querySelector('body')
}

refs.movieCard.addEventListener('click', openModal)
refs.closeBtn.addEventListener('click', closeModal)


function openModal() {
    refs.modal.classList.add('openModal');
    refs.body.style.overflow='hidden';
}
function closeModal() {
    refs.modal.classList.remove('openModal');
    refs.body.style.overflow='visible';

}
