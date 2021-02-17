// Gestion du select pour choisir le nombre de patients à afficher

let select = document.querySelector('#limit');

select.onchange = function () {
    let value = document.getElementById('limit').value;
    document.location.href = '/controllers/liste-patientsCtrl.php?limit=' + value;
}
