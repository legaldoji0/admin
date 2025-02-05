// fetch user from /api/auth/user
export const fetchUser = async () =>
  fetch('/api/auth/user')
    .then((res) => res.json())
    .then((data) => {
      if (data.data) {
        return data.data;
      }
      return null;
    });
