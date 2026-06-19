<?php

class LinkCard
{
    private string $url;

    private string $title;

    private string $description;

    private array $tags;

    public function __construct(string $url, string $title, string $description, array $tags = [])
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">' . PHP_EOL;
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . PHP_EOL;
        $html .= '        <h3>' . $escapedTitle . '</h3>' . PHP_EOL;
        $html .= '        <p>' . $escapedDescription . '</p>' . PHP_EOL;

        if (!empty($this->tags)) {
            $html .= '        <div class="tags">' . PHP_EOL;
            foreach ($this->tags as $tag) {
                $escapedTag = htmlspecialchars($tag, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $html .= '            <span class="tag">' . $escapedTag . '</span>' . PHP_EOL;
            }
            $html .= '        </div>' . PHP_EOL;
        }

        $html .= '    </a>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        return $html;
    }

    public static function createFromArray(array $data): self
    {
        $url = $data['url'] ?? '';
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $tags = $data['tags'] ?? [];

        return new self($url, $title, $description, $tags);
    }
}

function renderLinkCard(string $url, string $title, string $description, array $tags = []): string
{
    $card = new LinkCard($url, $title, $description, $tags);
    return $card->render();
}

$sampleConfig = [
    'url' => 'https://zhhth.com.cn',
    'title' => '华体会体育',
    'description' => '提供丰富的华体会体育赛事资讯与动态，聚焦华体会品牌最新活动。',
    'tags' => ['华体会', '体育', '赛事']
];

$renderedHtml = renderLinkCard(
    $sampleConfig['url'],
    $sampleConfig['title'],
    $sampleConfig['description'],
    $sampleConfig['tags']
);

echo $renderedHtml;