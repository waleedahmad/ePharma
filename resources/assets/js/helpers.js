function getCSRFToken(){
    return $("meta[name=token]").attr('content')
}