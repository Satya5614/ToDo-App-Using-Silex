$(document).ready(function(){
   // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
   $('.modal-trigger').leanModal();
 });


function markAsDone(taskId){
  var tId = "#"+taskId;
  var id = tId.substring(10);
  $(tId).toggleClass("done");
  loadUrl("https://silextodoapp-satya5614.c9.io/web/update/"+id);
}

function deleteTask(id){
  var tId = "#taskId"+id;
  $(tId).hide();
  loadUrl("https://silextodoapp-satya5614.c9.io/web/delete/"+id);
}

function editTask(id, gId){
    taskLabelId = "#taskLabel"+id;
    editTaskFieldId = "#editTaskField"+id;
    //taskBody = $(taskLabelId).val();

    taskBody = document.getElementById("taskLabel"+id).innerText;
    document.getElementById("modalTaskField").value = taskBody;
    //document.getElementById("modalTaskField").focus();
    document.getElementById("taskId").value = id;
    document.getElementById("groupId").value = gId;
    //$("#modalTaskField").val()=taskBody;
    //$("#taskId").val()=id;
    console.log(taskLabelId+" "+editTaskFieldId+" "+taskBody);
    $(taskLabelId, editTaskFieldId).toggle();
}




function loadUrl(url)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            console.log(xmlhttp.responseText);
        }
    }
    console.log(url);
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
