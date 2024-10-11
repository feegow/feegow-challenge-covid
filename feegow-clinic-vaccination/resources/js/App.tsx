import { createRoot } from "react-dom/client";
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import Home from "./src/app/home/page";
import Login from "./src/app/login/page";
import Layout from "./src/app/layout";

const router = createBrowserRouter([
    {
        path: "/",
        element: <Layout />,
        children: [
            {
                path: "/",
                element: <Home />,
            },
            {
                path: "/login",
                element: <Login />,
            },
        ],
    },
]);

const root = createRoot(document.getElementById("root")!);
root.render(<RouterProvider router={router} />);
