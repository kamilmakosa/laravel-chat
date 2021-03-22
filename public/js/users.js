const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

searchIcon.onclick = ()=>{
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();
    if(searchBar.classList.contains("active")){
        searchBar.value = "";
        searchBar.classList.remove("active");
    }
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
    console.log(usersList.children);
    let wzor = new RegExp("^.*("+searchTerm+").*$","i");
    for (i=0;i<usersList.children.length;i++) {
        userName = usersList.children[i].querySelector('.details span').innerText;
        if (wzor.test(userName)) {
            usersList.children[i].style.display = 'block';
        } else {
            usersList.children[i].style.display = 'none';
        }
    }
}
