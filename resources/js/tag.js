const buttonCloses = document.querySelectorAll('.tag');
for (const buttonCloseElement of buttonCloses) {
    buttonCloseElement.addEventListener('click', removeTag)
}

function removeTag(event) {
    let parentTag = event.target.closest('.tag');
    parentTag.remove();
}
