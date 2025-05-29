// Example using Pinia (stores/auth.ts)
import { defineStore } from 'pinia';

interface User {
  uid: number;
  username: string;
  email: string;
  name: string;
}

interface UserResponse {
  isLoggedIn: boolean;
  user?: User;
}

interface LoginCredentials {
  user: string;
  pass: string;
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    loggedIn: false,
    user: null as User | null,
  }),
  actions: {
    async login(credentials: LoginCredentials) {
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
      const { $fetch } = useT3Api();

      try {
        const response = await $fetch<UserResponse>('/login/get-user-data', {
          credentials: 'include'
        });

        if (response.isLoggedIn && response.user) {
          this.loggedIn = true;
          this.user = response.user;
        } else {
          this.logout();
        }
      } catch (error) {
        this.logout();

      }
    },
    setUser(userData: User) {
      this.loggedIn = true;
      this.user = userData;
    },
    logout() {
      const { $fetch } = useT3Api();

      $fetch('/login?logintype=logout', {
        credentials: 'include'
      }).then(res => {
        console.log(res)
      }).catch(e => {
        console.log(e)
      }).finally(() => {
        this.loggedIn = false;
        this.user = null;
        navigateTo('/'); // Redirect to home or login page after logout
      })
    },
  },
  persist: true
  // Persist state to localStorage (optional, for UX improvement)
  // You might want to use a Nuxt plugin for this with Pinia
});
