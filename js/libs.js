function $id(element) {
  return document.getElementById(element);
}
function show(str){
	var bt=$id(str)
	bt.className="";
}
function hide(str){
	var bt=$id(str)
	var txt=$id(str+'_t')
	if(txt!=null)txt.value="";
	bt.className="none";
}
function warning(str){
	var info=$id(str+'_w')
	info.className="";
}
function getRadio(str)
{
	var obj;    
	obj=document.getElementsByName(str);
	if(obj!=null){
		var i;
		for(i=0;i<obj.length;i++){
			if(obj[i].checked){
				return obj[i].value;            
			}
		}
	}
	return '';
}