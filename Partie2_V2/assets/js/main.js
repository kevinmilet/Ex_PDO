// Gestion du select pour choisir le nombre de patients ou rdv à afficher

let select = document.querySelector('#limit');

if (select != undefined) {
    select.onchange = function () {
        let pageType = document.getElementById('pageType').value;
        let limit = document.getElementById('limit').value;
        document.location.href = '/controllers/paginationCtrl.php?pageType=' + pageType  + '&limit=' + limit;
    }
}

// Gestion suppression patient

let delBtn = document.querySelectorAll('.del-btn');
console.log(delBtn);

delBtn.forEach(element => {
    console.log(element);

    let id = element.getAttribute('data');
    console.log(id);

    element.addEventListener('click', delEntry());
});

function delEntry() {
    const modal = new mdb.Modal(document.querySelector('#patient-del-confirm'));
    modal.show();
}