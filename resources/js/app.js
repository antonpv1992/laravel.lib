require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let USERS = [];

if(document.querySelector(".collapse")){
    let button = document.querySelectorAll(".border-primary");
    for(let i = 0; i < button.length; i++) {
        button[i].addEventListener('click', (e) => {
            let icon = e.target.firstElementChild;
            if(e.target.getAttribute("aria-expanded") === 'true') {
                icon.classList.remove("fa-arrow-circle-down");
                icon.classList.add("fa-arrow-circle-up");
                e.target.setAttribute("aria-expanded", false);
            } else {
                icon.classList.remove("fa-arrow-circle-up");
                icon.classList.add("fa-arrow-circle-down");
                e.target.setAttribute("aria-expanded", true);
            }
        })
    }
}

if(document.querySelector(".filter")) {
    let filter = document.querySelectorAll(".filter > .dropdown-menu");
    stopPropagationGroup(filter);
    let sort = document.querySelectorAll(".sort > .dropdown-menu");
    stopPropagationGroup(sort)
    let formSwitch = document.querySelectorAll(".sort .dropdown-menu > .dropdown-item .form-switch");
    disableBookFilters(formSwitch);
    for(let i = 0; i < formSwitch.length; i++){
        clickBookSort(formSwitch, i);
    }
    checkBookSorts();
    checkBookFilters();

}

if(document.querySelector(".menu__search")) {
    let search = document.querySelector(".menu__search");
    let searchButton = search.nextElementSibling;
    search.addEventListener('click', autoCheckFilter)
    searchButton.addEventListener('click', autoCheckFilter)
}

function autoCheckFilter() {
    let checkedFilter = document.querySelectorAll('input[name="filter[]"]:checked');
    if(checkedFilter.length === 0){
        checkedFilter = document.querySelectorAll('input[name="filter[]"]')
        checkedFilter[0].checked = true;
    }
}

function stopPropagationGroup(array) {
    for (let i = 0; i < array.length; i++){
        array[i].addEventListener('click', (e) => {
            e.stopPropagation();
        })
    }
}

function clickBookSort(formSwitch, index){
    formSwitch[index].addEventListener('click', (e) => {
        disableBookFilters(formSwitch);
        let inputSort = e.target.parentElement.nextElementSibling;
        let radioSort;
        if(inputSort !== null){
            radioSort = e.target.parentElement.nextElementSibling.firstElementChild;
        }
        while(inputSort !== null) {
            inputSort.firstElementChild.disabled = false;
            inputSort.firstElementChild.checked = false;
            inputSort = inputSort.nextElementSibling;
        }
        if(e.target.parentElement.parentElement.nextElementSibling !== null){
            radioSort.checked = true;
        }
    })
}

function checkBookFilters() {
    let params = (new URL(document.location)).searchParams;
    let filterParams = params.getAll("filter[]");
    let inputFilter = document.querySelectorAll('input[name="filter[]"]');
    if(filterParams.length === 0){
        for(let i = 0; i < inputFilter.length; i++) {
            if (inputFilter[i].value === 'title'){
                inputFilter[i].checked = true;
            }
        }
    } else {
        for(let i = 0; i < inputFilter.length; i++) {
            for(let j = 0; j < filterParams.length; j++){
                if (inputFilter[i].value === filterParams[j]){
                    inputFilter[i].checked = true;
                }
            }
        }
    }
}

function checkBookSorts() {
    let params = (new URL(document.location)).searchParams;
    let checkedSorts = params.getAll("sort");
    let orderSorts = params.get("order");
    if(checkedSorts.length === 0) {
        let clear = document.querySelector('input[value="id"]')
        clear.checked = true;
    } else {
        checkBookOrder(checkedSorts, orderSorts);
    }
}

function checkBookOrder(checkedSorts, orderSorts) {
    let theme = document.querySelector('input[value=' + checkedSorts + ']');
    theme.checked = true;
    let container = theme.parentElement;
    if(container.nextElementSibling !== null){
        container.nextElementSibling.firstElementChild.disabled = false;
        container.nextElementSibling.nextElementSibling.firstElementChild.disabled = false;
        if(orderSorts === "down"){
            container.nextElementSibling.firstElementChild.checked = true;
        } else if(orderSorts === "up") {
            container.nextElementSibling.nextElementSibling.firstElementChild.checked = true;
        }
    }
}

function disableBookFilters(formSwitch){
    for(let i = 0; i < formSwitch.length; i++){
        if(formSwitch[i].firstElementChild.checked !== true){
            let inp = formSwitch[i].firstElementChild.parentElement.nextElementSibling;
            while(inp !== null){
                inp.firstElementChild.disabled = true;
                inp.firstElementChild.checked = false;
                inp = inp.nextElementSibling;
            }
        }
    }
}

if (document.querySelector("table")) {
    fillStorage();
    let scope = document.querySelectorAll('[scope="col"] > a');
    let search = document.querySelector('.users__search');
    let select = document.querySelector('.users__select');
    select.addEventListener('change', (e) => {
        let arr = [...USERS];
        let search = document.querySelector('.users__search').value;
        arr = arr.filter(element => element[e.target.value].toString().toLowerCase().match(search));
        let elem = getCurrentSortElem();
        let flag = getCurrentSortDir();
        elem = getColContent(elem);
        sortByData(arr, elem, flag);
        fillTable(arr);
    });
    search.addEventListener('keyup', (e) => {
        let arr = [...USERS];
        let opinion = document.querySelector('.users__select').value;
        arr = arr.filter(element => element[opinion].toString().toLowerCase().match(e.target.value));
        let elem = getCurrentSortElem();
        let flag = getCurrentSortDir();
        elem = getColContent(elem);
        sortByData(arr, elem, flag);
        fillTable(arr);
    })
    scope.forEach(element => {
        element.addEventListener('click', (e) => {
            let arr = [...USERS];
            let opinion = document.querySelector('.users__select').value;
            let search = document.querySelector('.users__search').value;
            arr = arr.filter(element => element[opinion].toString().toLowerCase().match(search));
            sortListener(e.target, arr);
        })
    });
}

function firstFillTable() {
    let arr = [...USERS];
    let opinion = document.querySelector('.users__select').value;
    let search = document.querySelector('.users__search').value;
    arr = arr.filter(element => element[opinion].toString().toLowerCase().match(search));
    let elem = getCurrentSortElem();
    let flag = getCurrentSortDir();
    elem = getColContent(elem);
    sortByData(arr, elem, flag);
    fillTable(arr);
}

function getCurrentSortElem() {
    if(document.querySelector('.users__order')){
        return document.querySelector('.users__order').parentElement;
    }
    return document.querySelector('.users__table-col > .text-decoration-none');
}

function getCurrentSortDir() {
    if(document.querySelector('.users__order')){
        return document.querySelector('.users__order').textContent === ' ▲';
    }
    return true;
}

function sortListener(element, storage) {
    let arr = [...storage];
    let target = element.tagName === 'A' ? element : element.parentElement;
    let key = getColContent(target);
    if (target.children[0]) {
        target.children[0].textContent = target.children[0].textContent === ' ▲' ? ' ▼' : ' ▲';
        if(target.children[0].textContent === ' ▲'){
            arr = sortByData(arr, key, true);
        } else {
            arr = sortByData(arr, key, false);
        }
    } else {
        clearThChildren();
        let span = document.createElement('span');
        span.classList.add('users__order');
        span.textContent = ' ▼';
        target.append(span);
        arr = sortByData(arr, key, false);
    }
    fillTable(arr);
}

function clearThChildren() {
    let scope = document.querySelectorAll('[scope="col"] > a');
    scope.forEach(element => {
        if (element.firstElementChild) {
            element.firstElementChild.remove();
        }
    })
}

async function ajaxData(url, method) {
    let request = await fetch(url, {
        method: method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },});
    let response = await request.json();
    return await response;
}

function fillStorage() {
    let button = document.createElement('button');
    button.addEventListener('click', async ()=> {
        USERS = await ajaxData("users/?", 'GET');
        firstFillTable();
    })
    button.click();
}

function sortByData(data, key, flag) {
    if(flag){
        data.sort((a, b) => a[key] > b[key] ? 1 : -1);
    } else {
        data.sort((a, b) => a[key] < b[key] ? 1 : -1);
    }
    return data;
}

function fillTable(data) {
    const table = document.querySelector('.users__table-body');
    table.innerHTML = "";
    if(data.length === 0){
        table.classList.add('col-sm-3');
        table.classList.add('mb-3');
        table.classList.add('mx-auto');
        table.classList.add('text-center');
        const tr = document.createElement('tr');
        tr.classList.add('users__table-row');
        const td = document.createElement('td');
        td.colSpan = 6;
        td.classList.add('users__table-col');
        td.textContent = 'No Users';
        tr.appendChild(td);
        table.appendChild(tr);
        return;
    }
    table.classList.remove('col-sm-3');
    table.classList.remove('mb-3');
    table.classList.remove('mx-auto');
    table.classList.remove('text-center');
    data.forEach((element) => {
        const tr = document.createElement('tr');
        tr.classList.add('users__table-row');
        Object.entries(element).forEach(([key, value]) => {
            let td;
            if(key === 'id'){
                td = document.createElement('th');
                td.scope = 'row';
                td.textContent = value;
            } else if(key === 'login') {
                td = document.createElement('td');
                const a = document.createElement('a');
                a.classList.add('text-decoration-none');
                a.classList.add('text-dark');
                a.href = 'user/' + value;
                a.textContent = value;
                td.appendChild(a);
            } else {
                td = document.createElement('td');
                td.textContent = value;
            }
            td.classList.add('users__table-col');
            tr.appendChild(td);
        });
        table.appendChild(tr);
    })
}

function getColContent(col) {
    let res = col.cloneNode(true);
    if (res.children[0]){
        res.removeChild(res.children[0]);
    }
    if(res.textContent.toLowerCase() === '#') {
        return 'id';
    } else if(res.textContent.toLowerCase() === 'user name') {
        return 'login';
    }
    return res.textContent.toLowerCase();
}
