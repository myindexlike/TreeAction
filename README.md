# TreeAction
Plugin for MODX Evolution to change default action in the resource tree.

Hide children Resources for selected Folders in resource tree and open tab with table of child resources after click on Folder.

## Install
* Create plugin with code from file *install/assets/plugins/treeaction.tpl*
* For support plugins on Document Data page:
  + add event into DataBase: run the query from *install/setup.data.sql* (set your database prefix)
  + replace your *manager/actions/document_data.static.php* file on file from this repository **or** add into your file before `</div><!-- end documentPane -->` next code:

  ```php
  <?php
// invoke OnDocDataRender event
$evtOut = $modx->invokeEvent('OnDocDataRender', array(
	'id' => $id,
	'template' => $content['template']
));

if (is_array($evtOut)) echo implode('', $evtOut);
?>
```
