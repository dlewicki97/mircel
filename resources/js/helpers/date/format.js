let formatNumber = num => num.toString().length == 1 ? '0' + num : num;

let formatTime = time => formatNumber(new Date(time).getHours()) + ':' + formatNumber(new Date(time).getMinutes());

let formatDate = date => `${new Date(date).getFullYear()}-${String((new Date(date).getMonth() + 1)).length == 1 ? '0'+ (new Date(date).getMonth() + 1) : (new Date(date).getMonth() + 1)}-${formatNumber(new Date(date).getDate())}`;

let getSeconds = time => (parseInt(time.substr(0,2)) * 3600) + (parseInt(time.substr(3,2)) * 60); 

export default {
	formatNumber, formatTime, formatDate, getSeconds
}