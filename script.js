/*
document.addEventListener('DOMContentLoaded', (event) => {
    const arrows = document.querySelectorAll('.arrow');

    for (let i = 0; i < arrows.length; i++) {
        arrows[i].addEventListener('click', () => {
            arrows.forEach(a => a.classList.remove('rotate'));
            arrows[i].classList.add('rotate');

            showDesc(i);
        });
    }
});

function showDesc(arr){
    const desc = document.querySelectorAll('.desc');

    desc.forEach(d => d.classList.remove('descOpen'));

    desc[arr].classList.add('descOpen');
}
*/