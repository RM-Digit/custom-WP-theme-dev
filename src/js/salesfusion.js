
function quest_use_label_as_placeholder() {
    var _labels = document.querySelectorAll('form td > span');

    if (_labels.length > 0) for (var i in _labels) {
        var _label = _labels[i];
        var _td = _label.parentNode;
        if (_td != null && _td.cellIndex == 1) {
            //It's a label
            var _td2 = _td.nextElementSibling;
            if (_td2 !== null) {
                var _inputs = _td2.getElementsByTagName('input');
                if (_inputs.length > 0) {
                    for (var j in _inputs) {
                        var _input = _inputs[j];
                        _input.placeholder = _label.innerText;

                        if (_input.type === 'checkbox') {
                            var _spanObj = document.createElement('span');
                            _td2.lastElementChild.style.display = 'none';
                            _spanObj.innerText = _label.innerText;
                            _td2.appendChild(_spanObj);

                        }
                    }
                    _td.style.display = 'none';
                }
                var _inputs = _td2.getElementsByTagName('textarea');
                if (_inputs.length > 0) {
                    for (var j in _inputs) {
                        var _input = _inputs[j];
                        _input.placeholder = _label.innerText;
                    }
                    _td.style.display = 'none';
                }
            }
        }

    }
}
document.querySelector("#aspnetForm").addEventListener("submit", function(e){
    var _labels = document.querySelectorAll('form td >input + span');
    if (_labels.length > 0) for (var i=0; i<_labels.length;i++) {
        var _label = _labels[i]
        var _style = _label.style.visibility;
        if(_style == 'visible'){
            var _input = _label.previousElementSibling;
            _input.style.borderColor= 'red';
        }
        if(_style == 'hidden'){
            var _input = _label.previousElementSibling;
            _input.style.borderColor= 'white';
        }
    }
});
quest_use_label_as_placeholder();
function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}