// Example using Pinia (stores/auth.ts)
import { defineStore } from 'pinia';
import { useT3Api, navigateTo } from '#imports';
import 'pinia-plugin-persistedstate';
import { nextTick } from 'vue';

interface User {
  uid: number;
  username: string;
}

export type UserResponse = {
  content: {
    data: {
      isLoggedIn: boolean;
      user: User;
    }
  }
}

interface LoginCredentials {
  user: string;
  pass: string;
} 

export type LoginFormValues = LoginCredentials & Record<string, string>;

export type LoginFormResponse = {
  content: {
    data: {
      login: string,
      status: "success" | "failure"
    }
  }
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    loggedIn: false,
    user: null as User | null,
  }),
  actions: {
    async login(loginFormValues: LoginFormValues) {
      if(this.loggedIn) {
        this.logout(); 
        return null
      };
      
      const { $fetch } = useT3Api();
      try {
        // Perform login request to TYPO3 felogin endpoint
        // In a truly headless setup, felogin might redirect, or you might have a custom endpoint.
        // Assuming your TYPO3 setup returns user data or a success status upon cookie creation.
        // For instance, after the felogin POST, you might make a GET request to a /me endpoint.

        // Example: Simulating a successful login and fetching user
        // Replace with your actual API call

        const res=await $fetch<LoginFormResponse>('/login/', { // Your login endpoint
          method: 'POST',
          credentials: "include",
          body: new URLSearchParams({
            ...loginFormValues,
            responseElementId: "338"
          }),
        });
        console.log(res);
        if (res.content?.data?.status !== "success") throw new Error("Login failed");

        this.loggedIn = true;

        await nextTick();
        const user = await this.fetchUser();
        return user;

      } catch (error) {
        this.loggedIn = false;
        this.user = null;
        console.error('Login failed:', error);
        throw error;
        // Handle login error (e.g., show a message)
      }
    },
    async fetchUser() {
      const { $fetch } = useT3Api();

      try {
        const response = await $fetch<UserResponse>('/user/', {
          method: 'POST',
          credentials: 'include',
          body: new URLSearchParams({
            responseElementId: '424'
          })
        });
        console.log({response});

        if(!response.content?.data?.isLoggedIn || !response.content?.data?.user) {
          console.log("User not logged in or could not be fetched. Logging out.");
          this.logout(true);
          return null;
        }

        this.setUser(response.content?.data?.user);
        return response.content?.data?.user;
      
      } catch (error) {
        console.log(error);
        
        this.logout(true);
        return null;
      }
    },
    setUser(userData: User) {
      this.loggedIn = true;
      this.user = userData;
    },
    logout(skipRedirect: boolean = false) {
      this.loggedIn = false;
      this.user = null;
      const { $fetch } = useT3Api();

      $fetch('/login?logintype=logout', {
        credentials: 'include'
      }).then((res: unknown) => {
        console.log(res)
      }).catch((e: unknown) => {
        console.log(e)
      }).finally(() => {
        if(!skipRedirect) {
          navigateTo('/'); // Redirect to home or login page after logout
        }
      })
    },
  },
  persist: true
  // Persist state to localStorage (optional, for UX improvement)
  // You might want to use a Nuxt plugin for this with Pinia
});
