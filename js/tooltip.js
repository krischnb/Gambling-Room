const tooltip = document.createElement('div');
tooltip.className = 'tooltipCustom';
document.body.appendChild(tooltip);

document.querySelectorAll('[title]').forEach(el => {
  const titleText = el.getAttribute('title');
  el.dataset.tooltip = titleText;
  el.removeAttribute('title');

  el.addEventListener('mouseenter', e => {
    tooltip.textContent = el.dataset.tooltip;
    tooltip.style.opacity = '1';
    tooltip.style.display = 'block';
  });

  el.addEventListener('mousemove', e => {
    tooltip.style.left = `${e.pageX + 10}px`; 
    tooltip.style.top = `${e.pageY + 10}px`;
  });

  el.addEventListener('mouseleave', () => {
    tooltip.style.opacity = '0';
  });
});
