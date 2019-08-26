<script>
function formatDate(date) {
	date = new Date(date);
  	var day = date.getDate();
  	var month = date.getMonth()+1;
  	var year = date.getFullYear();
  	return `${day}/${month}/${year}`;
}
</script>