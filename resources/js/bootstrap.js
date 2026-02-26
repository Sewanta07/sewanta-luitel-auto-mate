import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.axios = axios;
window.Pusher = Pusher;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const appKey = import.meta.env.VITE_REVERB_APP_KEY;
const host = import.meta.env.VITE_REVERB_HOST ?? window.location.hostname;
const port = Number(import.meta.env.VITE_REVERB_PORT ?? 8080);
const scheme = import.meta.env.VITE_REVERB_SCHEME ?? (window.location.protocol === 'https:' ? 'https' : 'http');
const forceTLS = scheme === 'https';

if (appKey) {
	window.Echo = new Echo({
		broadcaster: 'reverb',
		key: appKey,
		wsHost: host,
		wsPort: port,
		wssPort: port,
		authEndpoint: '/broadcasting/auth',
		auth: {
			headers: {
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '',
			},
		},
		forceTLS,
		enabledTransports: ['ws', 'wss'],
	});
}

window.realtime = {
	subscribeUser(userId, callbacks = {}) {
		if (!window.Echo || !userId) {
			return null;
		}

		const channel = window.Echo.private(`App.Models.User.${userId}`);

		if (callbacks.notification) {
			channel.listen('.notification.created', callbacks.notification);
		}

		if (callbacks.payment) {
			channel.listen('.payment.status.updated', callbacks.payment);
		}

		if (callbacks.serviceStatus) {
			channel.listen('.service.status.updated', callbacks.serviceStatus);
		}

		if (callbacks.rentalStatus) {
			channel.listen('.rental.status.updated', callbacks.rentalStatus);
		}

		if (callbacks.earnings) {
			channel.listen('.earnings.updated', callbacks.earnings);
		}

		if (callbacks.withdrawal) {
			channel.listen('.withdrawal.status.updated', callbacks.withdrawal);
		}

		return channel;
	},

	subscribeChat(conversationId, callbacks = {}) {
		if (!window.Echo || !conversationId) {
			return null;
		}

		const channel = window.Echo.private(`chat.${conversationId}`);

		if (callbacks.message) {
			channel.listen('.chat.message.sent', callbacks.message);
		}

		if (callbacks.read) {
			channel.listen('.chat.message.read', callbacks.read);
		}

		if (callbacks.typing) {
			channel.listenForWhisper('typing', callbacks.typing);
		}

		return channel;
	},

	joinPresence(conversationId, callbacks = {}) {
		if (!window.Echo || !conversationId) {
			return null;
		}

		const channel = window.Echo.join(`presence.chat.${conversationId}`);

		if (callbacks.here) {
			channel.here(callbacks.here);
		}

		if (callbacks.joining) {
			channel.joining(callbacks.joining);
		}

		if (callbacks.leaving) {
			channel.leaving(callbacks.leaving);
		}

		return channel;
	},

	subscribeDashboard(role, id = null, callbacks = {}) {
		if (!window.Echo || !role) {
			return null;
		}

		let channelName = null;
		if (role === 'admin') {
			channelName = 'dashboard.admin';
		}

		if (role === 'customer' && id) {
			channelName = `dashboard.customer.${id}`;
		}

		if (role === 'staff' && id) {
			channelName = `dashboard.staff.${id}`;
		}

		if (!channelName) {
			return null;
		}

		const channel = window.Echo.private(channelName);

		if (callbacks.serviceStatus) {
			channel.listen('.service.status.updated', callbacks.serviceStatus);
		}

		if (callbacks.rentalStatus) {
			channel.listen('.rental.status.updated', callbacks.rentalStatus);
		}

		if (callbacks.paymentStatus) {
			channel.listen('.payment.status.updated', callbacks.paymentStatus);
		}

		if (callbacks.inventoryUpdated) {
			channel.listen('.inventory.updated', callbacks.inventoryUpdated);
		}

		if (callbacks.earningsUpdated) {
			channel.listen('.earnings.updated', callbacks.earningsUpdated);
		}

		if (callbacks.withdrawalUpdated) {
			channel.listen('.withdrawal.status.updated', callbacks.withdrawalUpdated);
		}

		if (callbacks.chatMessage) {
			channel.listen('.chat.message.sent', callbacks.chatMessage);
		}

		if (callbacks.chatRead) {
			channel.listen('.chat.message.read', callbacks.chatRead);
		}

		return channel;
	},
};
