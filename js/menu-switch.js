<script>
  document.querySelectorAll('.switch-tile').forEach(tile = {
    tile.addEventListener('click', () => {
      document.querySelectorAll('.switch-tile').forEach(t => t.classList.remove('selected'));
      tile.classList.add('selected');
    })
  })
  
</script>
