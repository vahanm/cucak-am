var count = "";   //Example: var count = "175";
function limiter(){
var tex = document.frmaddpost.post_content.value;
var len = tex.length;
if(len < count){
        tex = tex.substring(0,count);
        document.frmaddpost.post_content.value =tex;
        return false;
}
document.frmaddpost.limit.value = count+len;
}
