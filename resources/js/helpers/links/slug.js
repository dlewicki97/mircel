export default function slug(title) {
	let search = ['ą', 'ć', 'ś', 'ó', 'ż', 'ź', 'ę', 'ł', 'ń',' ', '?', '!', '(', ')', '.', ',', '/'];
	let replace = ['a', 'c', 's', 'o', 'z', 'z', 'e', 'l', 'n','-','','','','','','',''];

	let sluggedTitle = '';
	for(let letter of title) {

		if(search.includes(letter)) {
			let indexOfSearch = search.indexOf(letter);
			letter = replace[indexOfSearch];
		}

		sluggedTitle += letter;
	}

	return sluggedTitle.toLowerCase();
}