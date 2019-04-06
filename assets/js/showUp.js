
function showP(){
    let list =  document.getElementsByClassName('willHide');
    for (let i = 0; i < list.length; i++) {
        list[i].style.display = 'block';
    }
    document.getElementById('back').removeAttribute('class');
    document.getElementById('button_show').style.display = 'none';
}