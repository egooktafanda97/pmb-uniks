// Pickadate.js v3.5.6  *Buttons inside picker will not work in IE
// IE Fix: drop to v3.5.4 and disable picker on focus with $('.date-input').off('click focus');

// From Picker
var from_$input = $('#from-date').pickadate({
  editable: true,
  selectYears: 100,
  selectMonths: true,
  format: 'dd/mm/yyyy',
  min: false,
  max: false,
})

// To Picker
var to_$input = $('#to-date').pickadate({
  editable: true,
  selectYears: 100,
  selectMonths: true,
  format: 'mm/dd/yyyy',
  max: true,
})

var from_picker = from_$input.pickadate('picker')
var to_picker = to_$input.pickadate('picker')

// FROM Trigger
$('.from-datepicker-btn').on('click', function (e) {
  e.preventDefault()
  e.stopPropagation()

  // open picker
  from_picker.open()

  // Set TO min = FROM selected date
  from_picker.on('set', function (event) {
    var date = from_picker.get('select').date
    var month = from_picker.get('select').month
    var year = from_picker.get('select').year + 1

    if (event.select) {
      to_picker.set('select', from_picker.get('select'))
      $('#to-date').val('')
      to_picker.set('min', from_picker.get('select'))
      to_picker.set('max', [year, month, date])
    } else if ('clear' in event) {
      to_picker.set('min', false)
    }
  })
})

// TO Trigger
$('.to-datepicker-btn').on('click', function (e) {
  e.preventDefault()
  e.stopPropagation()

  // open picker
  to_picker.open()

  // Set FROM max = TO selected date
  to_picker.on('set', function (event) {
    if (event.select) {
      from_picker.set('max', to_picker.get('select'))
    } else if ('clear' in event) {
      from_picker.set('max', false)
    }
  })
})

// Date Mask via Vanilla Masker **https://github.com/fernandofleury/vanilla-masker
VMasker(document.querySelectorAll('.date-input')).maskPattern('99/99/9999')
