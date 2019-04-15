function clipboard4wiki(text) {
  var hiddenElement = document.createElement('textarea');
  hiddenElement.value = text;
  hiddenElement.width = '1px';
  hiddenElement.height = '1px';
  document.body.appendChild(hiddenElement);
  hiddenElement.select();
  document.execCommand('copy');
  document.body.removeChild(hiddenElement);
}
