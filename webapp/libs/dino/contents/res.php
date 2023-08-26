<?PHP



namespace Dino\Contents
{
    use Dino\General\File;
    use Dino\General\Folder;
    
    
    class Res
        extends Content
    {
        public
        function
        __get($prpt)
        {
            $name
            = strtolower(
                $prpt);
            
            if (!isset($this->_prpts[$name]))
            switch ($name)
            {
                //
                // Content
                //
                
                case 'name':
                    return
                    basename($this->path);
                    break;
                
                case 'folder':
                    $folder
                    = dirname($this->path);
                    
                    if ($folder == '.') {
                        $folder
                        = '';
                    }
                    
                    $this->_prpts['folder']
                    = $folder;
                    break;
                
                
                case 'contentfilepath':
                    $this->_prpts['contentfilepath']
                    = File::findExistsPath(
                        $this->contentName,
                        $this->contentFolderPath,
                        $this->contentFileExt);
                    break;
                
                case 'contentname':
                    return
                    $this->name;
                    break;
                
                case 'contentfolderpath':
                    $this->_prpts['contentfolderpath']
                    = Folder::branch(
                        WebApp::componentsFolderPath(),
                        $this->folder);
                    break;
                
                case 'contentfileext':
                    return
                    'php';
                    break;
                
                
                //
                // View
                //
                
                case 'view':
                    $view
                    = "Dino\\Views\\"
                    . $this->extension;
                    
                    if (!class_exists($view)) {
                        FatalError::viewNotFound(
                            __METHOD__,
                            $view);
                    }
                    
                    $this->_prpts['view']
                    = new $view(
                        $this->viewValues,
                        $this->viewFilePath);
                    break;
                
                case 'viewname':
                    return
                    $this->name;
                    break;
                
                case 'viewfoldername':
                    return
                    WebApp::viewFolderName();
                    break;
                
                case 'viewvalues':
                    $this->_prpts['viewvalues']
                    = array();
                    break;
                
                case 'viewfolderpath':
                    $this->_prpts['viewfolderpath']
                    = array(
                        $this->theme . '/'
                        . $this->extension .'/'
                        . $this->folder,
                        
                        $this->contentFolderPath . '/'
                        . $this->viewFolderName . '/'
                        . $this->extension);
                    break;
                
                case 'viewfilepath':
                    $this->_prpts['viewfilepath']
                    = File::findExistsPath(
                        $this->viewName,
                        $this->viewFolderPath,
                        $this->viewFileExt);
                    break;
                
                case 'viewfileext':
                    return
                    array(
                        $this->extension,
                        'php');
                    break;
            }
            
            return
            parent::__get($prpt);
        }
    }
}