const login = (username,password) => {
    if (username != 'admin' && password != 'admin') document.getElementsByClassName("alert-danger")[0].hidden = false;
    else document.getElementsByClassName("alert-success")[0].hidden = false;
}