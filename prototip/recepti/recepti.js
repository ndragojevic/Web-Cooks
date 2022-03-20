const rate = () => {
    console.log('rate');
}

const addCategoryTag = (tagName) => {
    document.getElementById("tags").append(tagName+",");
    console.log(tagName);
}