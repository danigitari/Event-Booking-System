import { api } from "./axios";
import axios from "axios";

export async function login(loginCredentials) {
    try {
        const res = await axios.post(
            "/api/login",
            loginCredentials,
            {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
            }
        );
        console.log(res);
        return res;
    } catch (error) {
        console.error(error);
        return error;
    }
}
export async function register(loginCredentials) {
    try {
        const res = await axios.post(
            "/api/register",
            loginCredentials,
            {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
            }
        );
        console.log(res);
        return res;
    } catch (error) {
        console.error(error);
        return error;
    }
}

export async function getUsers() { 
    try {
        const res = await api.get('/getUsers');
        return res.data;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}

export async function logout() 
{
    try {
        const res = await api.post('/logout');
        return res.data;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}
export async function getEvents() 
{
    try {
        const res = await api.post('/getEvents');
        return res.data;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}
export async function getEvent(id) 
{
    try {
        const res = await api.post('/getEvent/'+id);
        return res.data;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}