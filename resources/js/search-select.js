class Item {
    static items = [];
    tag;
    item;

    constructor(item) {
        this.item = item;
        Item.items.push();
    }

    static findByTag(tag) {
        for (const item of Item.items) {
            if (item.tag === tag)
                return item;
        }
    }

    static removeByTag(item) {
        item.tag.remove();
        item.item.removeAttribute('selected');
    }

    createTag(title, type = 'tag-primary') {
        let tag = document.createElement('div');
        tagContainer.appendChild(tag);
        tag.classList.add('tag', type);
        let span = document.createElement('span');
        span.innerText = title;
        let button = document.createElement('button');
        button.classList.add('btn-close');
        button.setAttribute('type', 'button');
        tag.appendChild(span);
        tag.appendChild(button);

        button.addEventListener('click', () => Item.removeByTag(this));
        this.tag = tag;
    }

    removeTag() {
        this.tag.remove();
    }
}

// Creating tag elements
const tagContainer = document.querySelector('.tag-container');

let searchSelects = document.querySelectorAll('.search-select');
let currentSearchSelect;

document.addEventListener('click', closeSearch, true);
for (const searchSelect of searchSelects) {

    let options = searchSelect.querySelector('.select-bar').querySelectorAll('option');
    // Create dropdown
    let dropdown = document.createElement('ul');
    searchSelect.appendChild(dropdown);
    dropdown.classList.add('dropdown-select');
    let index = 0;
    for (const option of options) {
        index++;
        let li = document.createElement('li');
        dropdown.appendChild(li);
        if (option.hasAttribute('disabled')) {
            li.toggleAttribute('disabled');
            li.style.cursor = 'auto';
            li.style.pointerEvents = 'none';
        }
        li.innerText = option.innerText;
        li.setAttribute('data-index', option.value);
        let icon = document.createElement('i');
        li.appendChild(icon);
        icon.classList.add('fa', 'fa-check');
        let item = new Item(li);
        // Select dropdown items
        li.addEventListener('click', () => toggleItem(event, item));

        // Make a max number for options to show
        if (index >= 7)
            li.style.display = 'none';

    }

    // Add search bar
    let searchbarContainer = document.createElement('div');
    searchSelect.appendChild(searchbarContainer);
    searchbarContainer.classList.add('search-bar-container');
    let searchbar = document.createElement('input');
    searchbarContainer.appendChild(searchbar);
    searchbar.classList.add('form-control', 'search-bar');
    searchbar.setAttribute('placeholder', 'جست و جو');
    // Toggle dropdown
    searchSelect.addEventListener('click', openSearch, true);

    // Search action
    let searchBar = searchSelect.querySelector('.search-bar');
    searchBar.addEventListener('keyup', search);
}


function closeSearch(event) {
    'use strict';
    if (event.target.closest('.search-select') !== currentSearchSelect && currentSearchSelect !== null) {
        currentSearchSelect.removeAttribute('toggle');
    }
}

function openSearch(event) {
    'use strict';
    currentSearchSelect = event.target.closest('.search-select');
    currentSearchSelect.setAttribute('toggle', '');
}

function toggleItem(event, item) {
    const li = event.target;
    li.toggleAttribute('selected');
    if (li.hasAttribute('selected')) {
        item.createTag(li.innerText);
    } else {
        item.removeTag();
    }

    let options = li.closest('.search-select').querySelector('.select-bar').querySelectorAll('option');
    for (const option of options) {
        if (option.value === li.getAttribute('data-index')) {
            option.selected = 'selected';

        }
    }
}

function search(event) {
    let bar = event.target;
    let listOfItems = bar.closest('.search-select').querySelector('.dropdown-select').querySelectorAll('li');
    let index = 0;
    for (const item of listOfItems) {

        let result = item.innerText.match(new RegExp(bar.value, "i"));
        if (result) {
            if (index < 7)
                item.style.display = 'block';
            index++;
        } else {
            item.style.display = 'none';

        }
    }
}

