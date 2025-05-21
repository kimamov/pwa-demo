// Example using Pinia (stores/auth.ts)
import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    loggedIn: false,
    user: null, // To store user data
  }),
  actions: {
    async login(credentials) {
      try {
        // Perform login request to TYPO3 felogin endpoint
        // In a truly headless setup, felogin might redirect, or you might have a custom endpoint.
        // Assuming your TYPO3 setup returns user data or a success status upon cookie creation.
        // For instance, after the felogin POST, you might make a GET request to a /me endpoint.

        // Example: Simulating a successful login and fetching user
        // Replace with your actual API call

        const { data: loginResponse, error: loginError } = await useFetch('/api/typo3/login', { // Your login endpoint
          method: 'POST',
          body: credentials,
        });

        if (loginError.value) throw loginError.value;

        // If login sets a cookie, now try to fetch user data
        await this.fetchUser();

      } catch (error) {
        this.loggedIn = false;
        this.user = null;
        console.error('Login failed:', error);
        // Handle login error (e.g., show a message)
      }
    },
    async fetchUser() {
      // This endpoint should require authentication (uses the cookie)
      const { data: userData, error } = await useFetch('/api/typo3/me'); // Your authenticated user endpoint

      if (userData.value) {
        this.loggedIn = true;
        this.user = userData.value;
      } else {
        this.loggedIn = false;
        this.user = null;
        if (error.value) {
          console.warn('Not logged in or error fetching user:', error.value);
        }
      }
    },
    setUser(userData){
      this.loggedIn=true;
      this.user=userData;
    },
    logout() {
      // Make a request to TYPO3's logout endpoint
      // This should invalidate the session cookie on the backend
      // useFetch('/api/typo3/logout', { method: 'POST' }); // Your logout endpoint

      this.loggedIn = false;
      this.user = null;
      // Optionally redirect to login or home page
      // useRouter().push('/login');
    },
  },
  persist: true
  // Persist state to localStorage (optional, for UX improvement)
  // You might want to use a Nuxt plugin for this with Pinia
});
