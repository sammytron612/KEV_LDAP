function confirmation()
{
    Toast1.fire().then((result) => {
    if (result.value) {
      return true
    } else {return false}
  })
}
