feather.replace()
//https://twitter.com/One_div

document.getElementById('sobre-nos').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('curvadao').scrollIntoView({
        behavior: 'smooth'
    });
});

document.getElementById('contato').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('rodape').scrollIntoView({
        behavior: 'smooth'
    });
});