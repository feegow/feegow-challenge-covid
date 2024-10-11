import { Flex, Heading } from "@radix-ui/themes";

export default function Header() {
    const { APP_NAME } = window as any;

    return (
        <Flex
            py="32px"
            align="center"
            justify="center"
            style={{ backgroundColor: "var(--gray-2)" }}
        >
            <Heading size="6" as="h1">
                {APP_NAME}
            </Heading>
        </Flex>
    );
}
