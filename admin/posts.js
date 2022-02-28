function buscaPost(path){

    let url = path+"/spfp.php";

    let val = document.querySelector('.busca_post').value;

    document.querySelector('.loading-img').classList.toggle('show-loading-img');

    if(val != ""){
        let params = "term='"+val+"'";

        let xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            let text = this.response;

            if(text == "0"){
                document.querySelector('.loading-img').classList.toggle('show-loading-img');

                document.querySelector('.request_post .request_post_content').innerHTML = "Nada...";
            }else{

                document.querySelector('.loading-img').classList.toggle('show-loading-img');

                document.querySelector('.request_post .request_post_content').innerHTML = this.response;
            }
        }
        xhttp.open('POST', url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(params);
    }else{
        document.querySelector('.loading-img').classList.toggle('show-loading-img');
        document.querySelector('.request_post .request_post_content').innerHTML = "";
    }

}