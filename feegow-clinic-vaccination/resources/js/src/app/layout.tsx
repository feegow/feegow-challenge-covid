import { Outlet } from "react-router-dom";
import { Container, Section, Flex } from "@radix-ui/themes";
import Header from "../components/header";
import Footer from "../components/footer";

export default function Layout() {
    return (
        <Flex direction="column" style={{ minHeight: "100vh" }}>
            <Header />
            <Container size="4">
                <main>
                    <Section py="6" style={{ flex: 1 }}>
                        <Outlet />
                    </Section>
                </main>
            </Container>
            <Footer />
        </Flex>
    );
}
