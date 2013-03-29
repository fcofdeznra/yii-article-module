function(fileUrl)
{
	// Helper function to get parameters from the query string.
	function getUrlParam(paramName)
	{
	  var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
	  var match = window.location.search.match(reParam) ;
	 
	  return (match && match.length > 1) ? match[1] : '' ;
	}
	var funcNum = getUrlParam('CKEditorFuncNum');
	window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
	window.close();
}