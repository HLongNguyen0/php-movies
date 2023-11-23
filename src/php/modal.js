const refs = {
    movieList: document.querySelector('.movies__list'),
    modal: document.querySelector('.modal'),
    modalWindow: document.querySelector('.modal__window'),
    body: document.querySelector('body')
}

refs.movieList.addEventListener('click', openModal);

function openModal(e) {
    if (!e.target.dataset.id) {
        return;
    }
    refs.modalWindow.innerHTML = "";
    refs.modal.classList.add('openModal');
    refs.body.style.overflow='hidden';

    r = new XMLHttpRequest();
    r.open("POST", "/src/php/api/api-modal.php");
    r.setRequestHeader("Content-Type", "application/json");
    
    params = {
        movieId: e.target.dataset.id,
        movieList: e.currentTarget.dataset.list
    };
    r.onload = () => {
        refs.modalWindow.innerHTML = r.response;
        refs.closeBtn = document.querySelector('.closeModal');
        refs.closeBtn.addEventListener('click', closeModal);
    }
    r.send(JSON.stringify(params));
}

function closeModal() {
    refs.modal.classList.remove('openModal');
    refs.body.style.overflow='visible';
}
