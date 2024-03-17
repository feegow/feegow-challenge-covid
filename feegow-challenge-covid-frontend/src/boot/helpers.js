// boot/helpers.js
const formatDateToPtBr = (data) => {
  if (!data) return ''
  const [ano, mes, dia] = data.split('-')
  return `${dia}/${mes}/${ano}`
}
const validateDate = (date) => {
  const regex = /^(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/]\d{4}$/
  return regex.test(date)
}

const formatDateToEnUS = (date) => {
  if (!date) return ''
  const [day, month, year] = date.split('/')
  return `${year}-${month}-${day}`
}
export { formatDateToPtBr, validateDate, formatDateToEnUS }
