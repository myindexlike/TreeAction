<?php

$output = '';

switch ($modx->event->name)
{
    case 'OnDocDataRender':
    if (in_array($id, explode(',',$nodes))){
      $output = "
      <script>
        docSettings.setSelectedIndex(1);
      </script>";
    }
    break;
    case 'OnManagerTreeRender':
    $output = "
    <script>
    var nodes = [".$nodes."];
    var len   = nodes.length;

    window.addCallListener = function(func, callback){
    // see: http://habrahabr.ru/post/135001/
      var callNumber = 0;
      return function(){
        var args = [].slice.call(arguments);
        var result;
        try {
          result = func.apply(this, arguments);
          callNumber++;
          } catch (e) {
            callback(e, args, this, callNumber);
            throw e;
          }
        callback(result, args, this, callNumber);
        return result;                 
      }
    };
    
    function treeActionCustom(el) {
      var id = el.getAttribute('data-id');
      itemToChange = id;
      menuHandler(1);
    };

    function changeNode(id) {
      var node = document.getElementById('node'+id);
      var img = document.getElementById('s'+id);
      var span = node.querySelector('span');
      
      if(img){ img.style.visibility = 'hidden'; }
      span.setAttribute('onclick', 'treeActionCustom(this); setSelected(this);');
      span.setAttribute('data-id', id);
    };

    rpcLoadData = addCallListener(rpcLoadData , function(result, args, self, callNumber){
      for (var i=0; i<len; i++){
        changeNode(nodes[i]);
      }
    });
    
	  </script>";
    break;
}

if($output != '') $modx->event->output($output);

