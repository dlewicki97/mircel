export default function fillBaseHeaders(blocks) {
	let block_headers = [];
	for(let block of blocks) {
		let headers = [
		{ text: 'Tytuł', align: 'start', value: 'title' },
		
		];
		if(block.answer) {
			headers[0] = { text: 'Odpowiedziano', align: 'center', value: 'answer', width: '10%'};
			headers.splice(1,0, {text: 'Temat', align: 'start', value: 'subject', width: '20%'}, {text: 'E-mail', align: 'start', value: 'email', width: '20%'});
		}
		if(block.order) headers.splice(0,0, { text: 'Kolejność', align: 'center', value: 'order', width: '10%' });
		if(block.name_column) headers[0] = { text: 'Imię i nazwisko', align: 'start', value: 'name'};
		if(block.is_paid) headers.splice(0,0, { text: 'Zapłacono', align: 'center', value: 'is_paid', width: '2%' });
		if(block.active) headers.splice(0,0, { text: 'Aktywny', align: 'center', value: 'active', width: '10%' });
		if(block.tablename == 'reservations') headers.splice(2,0, { text: 'Data i czas', align: 'center', value: 'entry', width: '20%' });
		if(block.tablename == 'users') headers.splice(1,0, { text: 'Blokuj', align: 'center', value: 'blocked', width: '10%' });
		if(block.home_page) headers.splice(0,0, { text: 'Pokaż na stronie głównej', align: 'center', value: 'home_page', width: '10%' });
		if(block.tablename == 'shop_orders') {
			headers[1] = {text: 'Wysłano', align: 'center', value: 'sent', width: '2%' }
			headers[2] = { text: 'Numer Zamówienia', align: 'center', value: 'id', width: '10%' };
			headers.splice(3,0, { text: 'Imię i nazwisko', align: 'center', value: 'main_name', width: '10%' });
		} 
		headers.push({ text: '', value: 'actions' });
		block_headers.push(headers); 

	}

	return block_headers;
}