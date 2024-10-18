function pad(num, size) {
  let s = `${num}`;
  while (s.length < size) s = "0" + s;
  return s;
}

function upperCaseFirst(str) {
  return str.charAt(0).toUpperCase() + str.slice(1)
}

function roundToTwo(num) {
  return +(Math.round(num + "e+2")  + "e-2");
}

function roundTo(precise, num) {
  return +(Math.round(num + `e+${precise}`)  + `e-${precise}`);
}

function getValueInPercent(amount, sent) {
  let val = 0;
  if (sent > 0) {
    val = Math.round(amount * 100 / sent, 2);
  }
  return val;
}

function animateScroll($el, offset, time) {
  return $el.animate({scrollTop: offset}, time);
}

const dateConvert = dateStr => {
  const date = new Date(dateStr);
  return date.toLocaleString('en-GB', {
    hour12:	false,
    day: 'numeric', month: 'short', year: 'numeric'
  });
};

export {
  upperCaseFirst,
  getValueInPercent,
  pad,
  roundToTwo,
  roundTo,
  animateScroll,
  dateConvert,
};
