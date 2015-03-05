function changeText(Surh_id , Surh_name, Surh_url, img) {
    var element = document.getElementById('element' + Surh_id);
    //var surhnumber = (Surh_id+1);
    var surhnumber = Surh_id;

    if (Surh_id > 114) {
        element.innerHTML = 'Not Found';
    }else{
    	if (element.innerHTML === surhnumber+'- '+Surh_name){
    	element.innerHTML = '<p><a href="'+Surh_url+'"><img src="'+img+'" alt="Download file" /></a><span>'+surhnumber+'- '+Surh_name+'</span></p><audio preload="auto" controls><source type="audio/mpeg" src="'+Surh_url+'" /></audio>';
        }else{
            element.innerHTML = surhnumber+'- '+Surh_name;
        }
    }
}