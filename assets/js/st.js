document.getElementById('cardNumber').addEventListener('input', function (e) {
    alert('Please enter');
    let inputValue = e.target.value.replace(/\D/g, '').substring(0,16);
    let formattedValue = '';
    for (let i = 0; i < inputValue.length; i++) {
      if (i % 4 === 0 && i !== 0) {
        formattedValue += ' ';
      }
      formattedValue += inputValue[i];
    }
    e.target.value = formattedValue;
  });
