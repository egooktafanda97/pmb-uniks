// ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
function alr(el, msg) {
  if (el) {
    $.toast({
      title: 'Opps!',
      subtitle: ``,
      content: `${msg}`,
      type: 'error',
      delay: 3000,
    })
    return true
  } else {
    return false
  }
}
