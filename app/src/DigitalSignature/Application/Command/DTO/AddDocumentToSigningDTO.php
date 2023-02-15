<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\DTO;

class AddDocumentToSigningDTO
{
    private string $doc;

    private string $successUrl;

    private string $failureURL;

    private string $additionalInfo;

    private ?string $selectedSignatureMethod;

    private ?string $cancelURL;

    public function __construct(
        string $doc,
        string $successUrl,
        string $failureURL,
        string $additionalInfo,
        string $selectedSignatureMethod = null,
        string $cancelURL = null
    ) {
        $this->doc = $doc;
        $this->successUrl = $successUrl;
        $this->failureURL = $failureURL;
        $this->additionalInfo = $additionalInfo;
        $this->selectedSignatureMethod = $selectedSignatureMethod;
        $this->cancelURL = $cancelURL;
    }

    public function getAdditionalInfo(): string
    {
        return $this->additionalInfo;
    }

    public function getCancelURL(): ?string
    {
        return $this->cancelURL;
    }

    public function getDoc(): string
    {
        return $this->doc;
    }

    public function getFailureURL(): string
    {
        return $this->failureURL;
    }

    public function getSelectedSignatureMethod(): ?string
    {
        return $this->selectedSignatureMethod;
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }
}
